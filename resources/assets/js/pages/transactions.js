/**
 * Transactions
 */

('use strict');

(function () {
  document.querySelectorAll('.nav-link').forEach(navLink => {
    const target = navLink.getAttribute('data-bs-target');

    navLink.addEventListener('click', () => {
      const url = new URL(window.location);
      url.searchParams.set('tab', target.replace('#', ''));
      window.history.pushState({}, '', url);
    });
  });

  document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('tab')) {
      const manageTab = new bootstrap.Tab(document.querySelector(`[data-bs-target="#${urlParams.get('tab')}"]`));
      manageTab.show();
    }
  });
})();
