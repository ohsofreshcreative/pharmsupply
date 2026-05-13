
(function () {
	document.querySelectorAll('.js-hero-sub-next').forEach(function (a) {
		a.addEventListener('click', function (e) {
			e.preventDefault();
			var hero = a.closest('.b-hero-sub');
			if (!hero) return;
			var next = hero.nextElementSibling;
			while (next && next.offsetHeight === 0) next = next.nextElementSibling;
			if (next) next.scrollIntoView({ behavior: 'smooth', block: 'start' });
		});
	});
})();