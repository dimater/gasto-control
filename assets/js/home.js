document.addEventListener('DOMContentLoaded', () => {
    // Seleccionar elementos del DOM
    const expenseFormPopup = document.getElementById('expense-form');
    const expenseFormContainer = document.getElementById('expense-form-container');
    const closePopupButton = document.querySelector('.close-popup');
    const categoryCards = document.querySelectorAll('.category-card');

    // Mostrar el formulario emergente al hacer clic en una tarjeta de categoría
    categoryCards.forEach(card => {
        card.addEventListener('click', () => {
            const categoryName = card.querySelector('h3').textContent;
            expenseFormPopup.style.display = 'block';
            expenseFormContainer.querySelector('input[name="category"]').value = categoryName;
        });
    });

    // Cerrar el formulario emergente
    closePopupButton.addEventListener('click', () => {
        expenseFormPopup.style.display = 'none';
    });

    // Manejar el envío del formulario
    expenseFormContainer.addEventListener('submit', async (e) => {
        e.preventDefault();

        // Obtener los datos del formulario
        const formData = new FormData(expenseFormContainer);
        const data = Object.fromEntries(formData.entries());

        try {
            // Enviar los datos al backend
            const response = await fetch('/api/add-expense', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            });

            if (response.ok) {
                alert('Gasto agregado exitosamente.');
                expenseFormPopup.style.display = 'none';
                expenseFormContainer.reset();
            } else {
                const error = await response.json();
                alert(`Error: ${error.message}`);
            }
        } catch (error) {
            console.error('Error al agregar el gasto:', error);
            alert('Hubo un problema al agregar el gasto. Inténtalo de nuevo.');
        }
    });
});