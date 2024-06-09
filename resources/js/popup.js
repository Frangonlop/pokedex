function confirmDelete(event) {
    event.preventDefault();
    const overlay = document.createElement('div');
    overlay.classList.add('modal-overlay');
    overlay.innerHTML = `
        <div class="custom-confirm">
            <p>¿Estás seguro de que deseas eliminar este equipo?</p>
            <button class="confirm-yes">Sí</button>
            <button class="confirm-no">No</button>
        </div>
    `;
    document.body.appendChild(overlay);

    overlay.querySelector('.confirm-no').addEventListener('click', () => {
        document.body.removeChild(overlay);
    });

    overlay.querySelector('.confirm-yes').addEventListener('click', () => {
        event.target.submit();
    });
}