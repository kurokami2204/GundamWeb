function openModal(id){
    let overLay = "modal-overlay-" + id;
    let container_modal = "modal-container-" + id;
    console.log(overLay);
    const modal = document.getElementById(overLay);
    const container = document.getElementById(container_modal);
    modal.classList.add("open-modal");
    modal.classList.remove("hidden");
    container.classList.remove("hidden");
}
function closeModal(id){
    let overLay = "modal-overlay-" + id;
    let container_modal = "modal-container-" + id;
    const modal = document.getElementById(overLay);
    const container = document.getElementById(container_modal);
    modal.classList.remove("open-modal");
    modal.classList.add("hidden");
    container.classList.add("hidden");
}
