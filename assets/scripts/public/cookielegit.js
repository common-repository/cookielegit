import LegitCookies from "./cookies";

export default class CookieLegitNotice {
  #target = null;
  #notice = null;
  #settings = null;
  #consentedTo = [];

  screens = ["notice", "preferences", "toggle-preferences"];

  consentCookieName = "cl_consent";

  cookieNames = ["cl_consent", "cl_essential", "cl_tracking", "cl_marketing"];

  defaultSettings = {
    baseUrl: null,
    userOpt: false,
    consentMode: false,
    cookieDuration: 182,
    themeUrl: null
  };

  static #events = {
    "cookie-legit-init": [],
    "notice-loaded": [],
    "consent-given": [],
    "consent-updated": [],
  };

  constructor(target, userSettings) {
    this.#settings = Object.assign({}, this.defaultSettings, userSettings);
    this.#target = this.selectTarget(target);
    this.checkConsentCookies();
    this.insertNotice();
    this.maybeInjectScripts();
    return this;
  }

  buildStyle(cookieNotice) {
    const tag = document.createElement('link');
    tag.href = this.#settings.themeUrl;
    tag.rel = 'stylesheet';
    tag.id = 'cookielegit-css';

    tag.onload = () => {
      cookieNotice.style.display = '';
    }

    document.head.append(tag);

  }

  checkConsentCookies() {
    LegitCookies.list()
      .filter((cookie) => cookie.name.startsWith("cl_"))
      .forEach((cookie) => this.#consentedTo.push(cookie));

    if (this.#settings.consentMode && this.#consentedTo.length > 0) {
      this.updateGTMConsent();
    }

    if (this.#consentedTo.length > 0) {
      CookieLegitNotice.#trigger('consent-given');
    }
  }

  selectTarget(target) {
    return document.querySelector(target);
  }

  async insertNotice() {
    let notice = await this.fetchNotice();
    this.#notice = document.createElement("div");
    this.#notice.id = "cookie-legit-notice-container";
    this.#notice.innerHTML = notice.html;
    this.#notice.style.display = 'none';

    let screen = this.#consentedTo.length === 0 ? "notice" : "toggle-preferences";
    this.#notice.classList.add(screen);

    this.#target.appendChild(this.#notice);
    // this.changeScreen(screen);
    this.setupEvents();

    if (this.#settings.userOpt) {
      this.setPrefToggles();
    }

    this.buildStyle(this.#notice);
  }

  async fetchNotice() {
    const request = await fetch(
      `${this.#settings.baseUrl}?action=get_cookie_notice`
    );
    return await request.json();
  }

  setupEvents() {
    if (this.#settings.userOpt) {
      this.#notice
        .querySelector(".cookie-legit-pref-btn")
        .addEventListener("click", () => this.toggleUserPreferences());
      this.#notice
        .querySelector(".cookie-legit-save-pref-btn")
        .addEventListener("click", () => this.savePreferences());
      this.#notice
        .querySelector(".cookie-legit-accept-pref-btn")
        .addEventListener("click", () => this.acceptAllCookies());
    } else {
      this.#notice
        .querySelector(".cookie-legit-deny-btn")
        .addEventListener("click", () => this.denyAllCookies());
    }

    this.#notice
      .querySelector(".cookie-legit-preferences-change")
      .addEventListener("click", () => this.updatePreferences());
    this.#notice
      .querySelector(".cookie-legit-accept-btn")
      .addEventListener("click", () => this.acceptAllCookies());
  }

  toggleUserPreferences() {
    this.changeScreen("preferences");
  }

  acceptAllCookies() {
    this.changeScreen("toggle-preferences");
    this.cookieNames.forEach((cookieName) => {
      LegitCookies.create(cookieName, true, this.#settings.cookieDuration);
    });
    this.checkConsentCookies();
  }

  savePreferences() {
    this.changeScreen("toggle-preferences");
    this.cookieNames.forEach((cookieName) => {
      let value =
        cookieName === this.consentCookieName
          ? true
          : this.#notice.querySelector(`input[name=${cookieName}]`).checked;
      LegitCookies.create(cookieName, value, this.#settings.cookieDuration);
    });
    this.checkConsentCookies();
  }

  updatePreferences() {
    let screen = this.#settings.userOpt ? "preferences" : "notice";
    this.changeScreen(screen);
    this.checkConsentCookies();
    CookieLegitNotice.#trigger('consent-updated');
  }

  denyAllCookies() {
    this.changeScreen("toggle-preferences");
    this.cookieNames.forEach((cookieName) => {
      let value = cookieName === this.consentCookieName ? true : false;
      LegitCookies.create(cookieName, value, this.#settings.cookieDuration);
    });
    this.checkConsentCookies();
  }

  changeScreen(activeScreen) {
    let inactiveScreens = this.screens.filter(
      (screen) => screen !== activeScreen
    );
    this.#notice.classList.remove(...inactiveScreens);
    this.#notice.classList.add(activeScreen);
  }

  setPrefToggles() {
    this.#consentedTo.forEach((cookie) => {
      let toggle = this.#notice.querySelector(`input[name=${cookie.name}]`);
      if (toggle) {
        toggle.checked = cookie.value === "true";
      }
    });
  }

  async maybeInjectScripts() {
    if (!this.#settings.userOpt || LegitCookies.find(this.consentCookieName) !== 'true') return;
    let scriptReq = await fetch(
      `${this.#settings.baseUrl}?action=get_tracking_scripts`
    );

    let scriptsWithPlacement = await scriptReq.json();
    for (const placement in scriptsWithPlacement) {
      if (Object.hasOwnProperty.call(scriptsWithPlacement, placement)) {
        const scripts = scriptsWithPlacement[placement];
        Object.values(scripts).forEach(script => {
          if (!this.isJSON(script)) {
            let tag = this.buildScript(placement, script);
            document.querySelector(placement).append(tag);
          } else {
            script = JSON.parse(script);
            for (const stype in script) {
              if (Object.hasOwnProperty.call(script, stype)) {
                const contents = script[stype];
                contents.forEach(content => {
                  let tag = this.buildScript(placement, content, stype === 'srcs');
                  document.querySelector(placement).append(tag);
                })
              }
            }
          }
        });
      }
    }
  }

  updateGTMConsent() {
    if (typeof gtag === "function") {
      return gtag("consent", "update", this.getGTMConsentObject());
    }

    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push({
      0: "consent",
      1: "update",
      2: this.getGTMConsentObject()
    });
  }

  getGTMConsentObject() {
    return {
      ad_storage:
        LegitCookies.find("cl_marketing")?.value === "true"
          ? "granted"
          : "denied",
      ad_user_data:
        LegitCookies.find("cl_marketing")?.value === "true"
          ? "granted"
          : "denied",
      ad_personalization:
        LegitCookies.find("cl_marketing")?.value === "true"
          ? "granted"
          : "denied",
      analytics_storage:
        LegitCookies.find("cl_tracking")?.value === "true"
          ? "granted"
          : "denied",
      security_storage: "granted",
    }
  }

  isJSON(objectString) {
    try {
      let json = JSON.parse(objectString)
    } catch (e) {
      return false;
    }

    return true;
  }

  buildScript(placement, scriptContent, isSrc = false) {
    let tagName = placement === 'head' ? 'script' : 'noscript';
    let tag = document.createElement(tagName);

    if (isSrc) {
      tag.src = scriptContent;
      return tag;
    }

    tag.textContent = scriptContent;
    return tag;
  }

  static subscribe(event, callback) {
    if (!this.#events[event])
      return console.warn(
        `Cannot subscribe to ${event} because it does not exist!`
      );
    if (typeof callback !== "function")
      return console.warn(
        `Expected callback for ${event} got ${typeof callback}`
      );
    this.#events[event].push(callback);
  }

  static #trigger(event) {
    const callbacks = this.#events[event];

    if (!callbacks) return console.warn(`Cannot trigger ${event} because it does not exist!`);

    for (let callback of callbacks) {
      callback();
    }
  }
}
