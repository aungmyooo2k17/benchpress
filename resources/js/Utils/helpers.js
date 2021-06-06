/**
 * Cleanup and normalize a URI string.
 *
 * @param   {String}  url
 *
 * @return  {String}
 */
export function tidyUrl(url) {
    return url.replace(/([^:])(\/\/+)/g, '$1/');
}
