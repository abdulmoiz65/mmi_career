document.addEventListener("DOMContentLoaded", function () {
    let visibleCount = 6; // jobs shown initially
    const increment = 6; // jobs to show per click
    const jobs = document.querySelectorAll(".job-card-wrapper");
    const loadMoreBtn = document.getElementById("loadMoreBtn");

    loadMoreBtn?.addEventListener("click", function () {
        let nextVisible = visibleCount + increment;

        for (let i = visibleCount; i < nextVisible && i < jobs.length; i++) {
            jobs[i].classList.remove("d-none");
        }

        visibleCount = nextVisible;

        if (visibleCount >= jobs.length) {
            loadMoreBtn.style.display = "none"; // hide button when done
        }
    });
});

