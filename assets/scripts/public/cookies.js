export default class LegitCookies {
  static list() {
    const cookies = [];
    const docCookies = document.cookie.split("; ");

    for (let i = 0; i < docCookies.length; i++) {
      const cookie = docCookies[i].split("=");
      const cookieName = cookie[0];
      let cookieValue = cookie.length > 1 ? cookie[1] : null;

      cookies.push({
        name: cookieName,
        value: cookieValue,
      });
    }

    return cookies;
  }

  static find(name = "") {
    const cookies = this.list();
    return cookies.find((cookie) => cookie.name === name) || null;
  }

  static create(name, value, expire = 1, path = "/") {
    const today = new Date();
    const expires_at = new Date(today.getTime() + (expire * 24 * 60 * 60 * 1000));

    document.cookie = `${name}=${value}; expires=${expires_at}; path=${path}`
    return this;
    
  }

  static delete(name) {
    document.cookie = `${name}=; Max-Age=-99999999;`;
    return this;
  }
}
