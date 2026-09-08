const initIndications = () => {
  document.querySelectorAll('.b-indications .__filters').forEach((panel) => {
    const updateSticky = () => {
      const topOffset = 5 * parseFloat(getComputedStyle(document.documentElement).fontSize);
      const viewportHeight = document.documentElement.clientHeight;
      panel.classList.toggle('__sticky-fits',
        window.matchMedia('(min-width: 1024px)').matches &&
        panel.getBoundingClientRect().height + topOffset + 16 <= viewportHeight
      );
    };

    panel.querySelectorAll('.__category-toggle').forEach((toggle) => {
      let animation;
      toggle.addEventListener('click', () => {
        const list = document.getElementById(toggle.getAttribute('aria-controls'));
        if (!list) return;
        const expanded = toggle.getAttribute('aria-expanded') !== 'true';
        toggle.setAttribute('aria-expanded', String(expanded));
        const currentStyle = getComputedStyle(list);
        const start = {
          height: `${list.getBoundingClientRect().height}px`,
          opacity: list.hidden ? 0 : currentStyle.opacity,
          marginTop: list.hidden ? '0px' : currentStyle.marginTop,
          marginBottom: list.hidden ? '0px' : currentStyle.marginBottom,
        };
        animation?.cancel();
        list.hidden = false;
        list.inert = !expanded;

        const naturalStyle = getComputedStyle(list);
        const end = {
          height: expanded ? `${list.scrollHeight}px` : '0px',
          opacity: expanded ? 1 : 0,
          marginTop: expanded ? naturalStyle.marginTop : '0px',
          marginBottom: expanded ? naturalStyle.marginBottom : '0px',
        };
        list.style.overflow = 'hidden';
        animation = list.animate([start, end], {
          duration: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 0 : 280,
          easing: 'cubic-bezier(0.22, 1, 0.36, 1)',
        });
        animation.onfinish = () => {
          list.hidden = !expanded;
          list.style.removeProperty('overflow');
          animation = null;
          updateSticky();
        };
        updateSticky();
      });
    });

    new ResizeObserver(updateSticky).observe(panel);
    window.addEventListener('resize', updateSticky, { passive: true });
    updateSticky();
  });
};

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initIndications);
} else {
  initIndications();
}
