const collapseEl = document.getElementById('collapseExample');
const tableColumn = document.getElementById('tableColumn');

collapseEl.addEventListener('shown.bs.collapse', () => {
    tableColumn.classList.remove('col-12');
    tableColumn.classList.add('col-9');
});

collapseEl.addEventListener('hidden.bs.collapse', () => {
    tableColumn.classList.remove('col-9');
    tableColumn.classList.add('col-12');
});

    window.addEventListener("load", () => {
        setTimeout(() => {
            const collapse = new bootstrap.Collapse(document.getElementById('collapseExample'), {
                toggle: true // true para que lo muestre
            });
        }, 10000); // 1000 milisegundos = 1 segundo
    });