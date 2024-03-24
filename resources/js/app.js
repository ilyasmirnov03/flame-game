import "./profil";
import "./params";
import "./flame";
import "./pwa_button";
import "./fun_fact";
import "./libs/shoelace.js";

/**
 * Get CSRF token from meta tag if set on page.
 * @returns {string|null}
 */
export function getCSRFToken() {
    const metaTag = document.querySelector('meta[name="csrf-token"]');
    return metaTag ? metaTag.getAttribute("content") : null;
}
