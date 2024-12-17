document.addEventListener("DOMContentLoaded", () => {
    const counters = document.querySelectorAll('.count');
    counters.forEach(counter => {
        const updateCount = () => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText; 
            const increment = target / 500; 

            if (count < target) {
                counter.innerText = Math.ceil(count + increment);
                setTimeout(updateCount, 50); 
            } else {
                counter.innerText = target; 
            }
        };
        updateCount();
    });
});
