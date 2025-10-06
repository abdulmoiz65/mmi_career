function showJobDetails(id, title, university, jobType, description, applications, contact, status, uploadDate) {
    document.getElementById('modalJobTitle').innerText = title;
    document.getElementById('modalUniversityName').innerText = university;
    document.getElementById('modalJobType').innerText = jobType;
    document.getElementById('modalDescription').innerText = description;
    document.getElementById('modalApplications').innerText = applications + " applications";
    document.getElementById('modalContact').innerText = contact;
    document.getElementById('modalUploadDate').innerText = uploadDate;


const applyLink = document.getElementById('applyLink');
    const footer = document.querySelector('.modal-footer');

    // 🔹 Remove old "closed" message if it exists
    const oldMsg = footer.querySelector('.job-closed-msg');
    if (oldMsg) oldMsg.remove();

    if (status === "Inactive") {
        applyLink.style.display = "none"; 
        footer.insertAdjacentHTML(
            'beforeend',
            '<span class="text-danger ms-2 job-closed-msg">This job is closed</span>'
        );
    } else {
        applyLink.style.display = "inline-block";
        applyLink.href = "/apply/" + id;
    }
}
