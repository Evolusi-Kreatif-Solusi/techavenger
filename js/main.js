document.addEventListener('DOMContentLoaded', () => {
    const winModal = document.getElementById('win-modal');
    const closeModalBtn = document.getElementById('close-modal-btn');
    const modalDaftarBtn = document.getElementById('modal-daftar-btn');

    // Example function to show the modal (you can call this based on your logic)
    // For this example, let's say it shows after a certain time
    // setTimeout(() => {
    //     winModal.classList.remove('hidden', 'opacity-0');
    //     winModal.classList.add('active', 'opacity-100');
    // }, 2000);

    function closeModal() {
        winModal.classList.remove('active', 'opacity-100');
        winModal.classList.add('hidden', 'opacity-0');
    }

    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', closeModal);
    }
    
    if (modalDaftarBtn) {
        modalDaftarBtn.addEventListener('click', closeModal);
    }
});

function toggleSyllabus(element) {
    const syllabus = element.nextElementSibling;
    const icon = element.querySelector('i');
    
    const isActive = syllabus.classList.contains('active');
    
    const allSyllabuses = document.querySelectorAll('.syllabus-content');
    const allIcons = document.querySelectorAll('.syllabus-item i');
    
    allSyllabuses.forEach(s => s.classList.remove('active'));
    allIcons.forEach(i => i.classList.remove('rotate-180'));

    if (!isActive) {
        syllabus.classList.add('active');
        icon.classList.add('rotate-180');
    }
}

function toggleFaq(element) {
    const answer = element.nextElementSibling;
    const icon = element.querySelector('i');
    
    const isActive = answer.classList.contains('active');

    document.querySelectorAll('.faq-answer.active').forEach(a => a.classList.remove('active'));
    document.querySelectorAll('.faq-question.active').forEach(q => q.classList.remove('active'));

    if (!isActive) {
        answer.classList.add('active');
        element.classList.add('active');
        icon.classList.add('rotate-180');
    }
}