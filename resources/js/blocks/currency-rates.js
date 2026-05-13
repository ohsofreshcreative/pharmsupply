document.querySelectorAll('[data-currency-rates]').forEach((root) => {
    const select = root.querySelector('[data-currency-select]');
    if (select) {
        select.addEventListener('change', (e) => {
            const slug = e.target.value;
            root.querySelectorAll('[data-currency-panel]').forEach((panel) => {
                panel.classList.toggle('hidden', panel.dataset.currencyPanel !== slug);
            });
        });
    }

    root.querySelectorAll('[data-currency-panel]').forEach((panel) => {
        const toggle = panel.querySelector('[data-currency-toggle]');
        if (!toggle) return;
        const extras = panel.querySelectorAll('[data-currency-extra]');
        if (!extras.length) return;

        const labelMore = toggle.dataset.labelMore || toggle.textContent.trim();
        const labelLess = toggle.dataset.labelLess || 'Pokaż mniej';
        let expanded = false;

        toggle.addEventListener('click', () => {
            expanded = !expanded;
            extras.forEach((row) => row.classList.toggle('hidden', !expanded));
            toggle.textContent = expanded ? labelLess : labelMore;
            toggle.setAttribute('aria-expanded', expanded ? 'true' : 'false');
        });
    });
});