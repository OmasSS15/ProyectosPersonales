//DataTable
let dataTableFiles;
let dataTableFiles2;
let dataTableUsers;
let dataTableHistorial;
let dataTableSucursal;
let dataTableEstado;
let dataTableRol;
// Inicializar datatable en false
let dataTableIsInitialized = false;

$.fn.dataTable.ext.pager.numbers_length = 3;
// Configuracion del DataTable
function getDataTableOptions(customDefs = {}) {
    return {
        // scrollX: "500px",
        // searching: false,
        columnDefs: [
            { orderable: false, targets: customDefs.orderable || [] },
            { searchable: false, targets: customDefs.searchable || [] }
        ],
        pageLength: 5,
        destroy: true,
        language: {     
            lengthMenu: "Mostrar _MENU_ registros por página", 
            zeroRecords: "Ningún registro coincide con tu búsqueda",
            info: "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros", 
            infoEmpty: "Ningún registro encontrado",
            infoFiltered: "(filtrados desde _MAX_ registros totales)",
            search: "Buscar:",
            loadingRecords: "Cargando...",
            paginate: {
                first: "<i class='bx bxs-chevrons-left'></i>",
                last: "<i class='bx bxs-chevrons-right'></i>", 
                next: "<i class='bx bxs-chevron-right'></i>", 
                previous: "<i class='bx bxs-chevron-left'></i>"
            },
            emptyTable: "No hay datos disponibles"
        }
    };
}

const dataTableOptions = getDataTableOptions({
    orderable: [1, 2, 3, 4, 7, 8],
    searchable: [0, 5, 6, 7, 8]
});

const dataTableOptions2 = getDataTableOptions({
    orderable: [1, 2, 5, 6],
    searchable: [0, 3, 4, 6]
});

const dataTableOptions3 = getDataTableOptions({
    orderable: [1, 2, 3, 6, 7],
    searchable: [0, 4, 5, 6, 7]
});

const dataTableOptions4 = getDataTableOptions({
    orderable: [1, 2, 5, 6],
    searchable: [0, 4, 5, 6]
});

const dataTableOptions5 = getDataTableOptions({
    orderable: [1, 2, 3, 4],
    searchable: [0, 3, 4]
});

const dataTableOptions6 = getDataTableOptions({
    orderable: [1, 2],
    searchable: [0, 2]
});

const initDataTable = async () => { 
    if (dataTableIsInitialized) {
        dataTableFiles.destroy();
        dataTableFiles2.destroy();
        dataTableUsers.destroy();
        dataTableHistorial.destroy();
        dataTableSucursal.destroy();
        dataTableEstado.destroy();
        dataTableRol.destroy();
    }

    // Mostrar datos de JSONPlaceholder
    // await listUsers();
    
    dataTableFiles = $("#datatable_files").DataTable(dataTableOptions);
    dataTableFiles2 = $("#datatable_files2").DataTable(dataTableOptions3);
    dataTableHistorial = $("#datatable_files3").DataTable(dataTableOptions2);
    dataTableUsers = $("#datatable_users").DataTable(dataTableOptions);
    dataTableSucursal = $("#datatable_sucursales").DataTable(dataTableOptions4);
    dataTableEstado = $("#datatable_estados").DataTable(dataTableOptions5);
    dataTableRol = $("#datatable_rol").DataTable(dataTableOptions6);
    
    // Inicializar datatable en true
    dataTableIsInitialized = true;


};

// JSONPlaceholder
// const listUsers = async () => {
//     try {
//         // Conexión con la API
//         const response = await fetch("https://jsonplaceholder.typicode.com/users");
//         const data = await response.json();
//         console.log(data);   
//         let content=``;
//         data.forEach((user, index)=>{
//             // Contenido
//             content+=`
//             <tr>
//                 <td scope="row">${index+1}</td>
//                 <td>${user.username}</td>
//                 <td>${user.name}</td>
//                 <td>${user.username}</td>
//                 <td>${user.username}</td>
//                 <td>${user.username}</td>
//                 <td>${user.username}</td>
//                 <td><i class='bx bxs-check-circle' style="color: green;" ></i></td>
//                 <td><button type="button" class="btn btn-danger"><i class='bx bxs-download'></i></button></td>
//             </tr>`;
            
//         });
//         tableBody_users.innerHTML = content;
//     } catch (ex) {
//         alert(ex);
//     }
// };

// Mostrar datos en la vista
window.addEventListener("load", async () => {
    // await listUsers();
    await initDataTable();
});
