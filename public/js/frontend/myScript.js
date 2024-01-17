function openModal(){
    const modal = document.getElementById("modal-overlay");
    const container = document.getElementById("modal-container");
    modal.classList.add("open-modal");
    modal.classList.remove("hidden");
    container.classList.remove("hidden");
}
function closeModal(){
    const modal = document.getElementById("modal-overlay");
    const container = document.getElementById("modal-container");
    modal.classList.remove("open-modal");
    modal.classList.add("hidden");
    container.classList.add("hidden");
}