/**
 * Sticky Cookie
 */

export function setCookie(key, value, expiry, path = "/") {
    const expires = new Date();
    expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
    document.cookie = key + "=" + value + ";expires=" + expires.toUTCString() + "; path=" + path;
}

export function getCookie(key) {
    const keyValue = document.cookie.match("(^|;) ?" + key + "=([^;]*)(;|$)");
    return keyValue ? keyValue[2] : null;
}

export function eraseCookie(key) {
    const keyValue = getCookie(key);
    setCookie(key, keyValue, "-1");
}