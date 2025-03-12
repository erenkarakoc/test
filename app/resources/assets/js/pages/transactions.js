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
      url.searchParams.delete('page');

      window.history.pushState({}, '', url);
      window.location.reload();
    });
  });

  document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('tab')) {
      const tab = new bootstrap.Tab(document.querySelector(`[data-bs-target="#${urlParams.get('tab')}"]`));
      tab.show();
    }
  });

  window.addEventListener('popstate', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const tab = new bootstrap.Tab(document.querySelector(`[data-bs-target="#${urlParams.get('tab')}"]`));
    tab.show();
  });
})();
