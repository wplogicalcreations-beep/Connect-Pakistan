// Shared URL helpers, loaded by every layout before page scripts.

// Returns the absolute URL only if it points to this site's own origin, otherwise null.
// Prevents AJAX requests (and the HTML they return) from being redirected to another host.
function toSameOriginUrl(rawUrl) {
    try {
        const parsed = new URL(rawUrl, window.location.href);
        return parsed.origin === window.location.origin ? parsed.href : null;
    } catch (e) {
        return null;
    }
}
