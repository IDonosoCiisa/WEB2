function openModal(modalId, project = null) {
    if (project) {
        $('#update_project_id').val(project.id);
        $('#update_nombre').val(project.nombre);
        $('#update_responsable').val(project.responsable);
        $('#update_fecha_inicio').val(project.fecha_inicio);
        $('#update_estado').val(project.estado);
        $('#update_monto').val(project.monto);
    }
    document.getElementById(modalId).classList.remove('hidden');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}
$(document).ready(function() {


    function createProject() {
        const data = {
            nombre: $('#nombre').val(),
            responsable: $('#responsable').val(),
            fecha_inicio: $('#fecha_inicio').val(),
            estado: $('#estado').val(),
            monto: $('#monto').val(),
            created_by: $('#created_by').val(),
            _token: $('input[name="_token"]').val()
        };

        $.ajax({
            url: '/proyectos',
            type: 'POST',
            data: data,
            success: function(response) {
                $('#projectTable').append(`
                    <tr id="project-${response.id}">
                        <td class="py-2 px-4 border-b">${response.nombre}</td>
                        <td class="py-2 px-4 border-b">${response.responsable}</td>
                        <td class="py-2 px-4 border-b">${response.fecha_inicio}</td>
                        <td class="py-2 px-4 border-b">${response.estado ? 'Active' : 'Inactive'}</td>
                        <td class="py-2 px-4 border-b">${response.monto}</td>
                        <td class="py-2 px-4 border-b">
                            <button class="bg-blue-600 text-white px-2 py-1 rounded-md view-btn" data-id="${response.id}">Ver</button>
                            <button class="edit-btn bg-yellow-500 text-white px-2 py-1 rounded-md" data-id="${response.id}">Editar</button>
                            <button class="delete-btn bg-red-600 text-white px-2 py-1 rounded-md" data-id="${response.id}">Borrar</button>
                            ${response.estado ?
                    `<button class="deactivate-btn bg-gray-600 text-white px-2 py-1 rounded-md" data-id="${response.id}">Desactivar</button>` :
                    `<button class="activate-btn bg-green-600 text-white px-2 py-1 rounded-md" data-id="${response.id}">Activar</button>`
                }
                        </td>
                    </tr>
                `);
                closeModal('createModal');
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    function updateProject() {
        const id = $('#update_project_id').val();
        const data = {
            nombre: $('#update_nombre').val(),
            responsable: $('#update_responsable').val(),
            fecha_inicio: $('#update_fecha_inicio').val(),
            estado: $('#update_estado').val(),
            monto: $('#update_monto').val(),
            _token: $('input[name="_token"]').val(),
            _method: 'PUT'
        };

        $.ajax({
            url: `/proyectos/${id}`,
            type: 'PUT',
            data: data,
            success: function(response) {
                $(`#project-${id}`).replaceWith(`
                    <tr id="project-${response.id}">
                        <td class="py-2 px-4 border-b">${response.nombre}</td>
                        <td class="py-2 px-4 border-b">${response.responsable}</td>
                        <td class="py-2 px-4 border-b">${response.fecha_inicio}</td>
                        <td class="py-2 px-4 border-b">${response.estado ? 'Active' : 'Inactive'}</td>
                        <td class="py-2 px-4 border-b">${response.monto}</td>
                        <td class="py-2 px-4 border-b">
                            <button class="bg-blue-600 text-white px-2 py-1 rounded-md view-btn" data-id="${response.id}">Ver</button>
                            <button class="edit-btn bg-yellow-500 text-white px-2 py-1 rounded-md" data-id="${response.id}">Editar</button>
                            <button class="delete-btn bg-red-600 text-white px-2 py-1 rounded-md" data-id="${response.id}">Borrar</button>
                            ${response.estado ?
                    `<button class="deactivate-btn bg-gray-600 text-white px-2 py-1 rounded-md" data-id="${response.id}">Desactivar</button>` :
                    `<button class="activate-btn bg-green-600 text-white px-2 py-1 rounded-md" data-id="${response.id}">Activar</button>`
                }
                        </td>
                    </tr>
                `);
                closeModal('updateModal');
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    function activateProject(id) {
        $.ajax({
            url: `/proyectos/${id}/activate`,
            type: 'PATCH',
            data: {
                _token: $('input[name="_token"]').val()
            },
            success: function(response) {
                $(`#project-${id} td:nth-child(4)`).text('Active');
                $(`#project-${id} td:nth-child(6)`).html(`
                    <button class="bg-blue-600 text-white px-2 py-1 rounded-md view-btn" data-id="${response.id}">Ver</button>
                    <button class="edit-btn bg-yellow-500 text-white px-2 py-1 rounded-md" data-id="${response.id}">Editar</button>
                    <button class="delete-btn bg-red-600 text-white px-2 py-1 rounded-md" data-id="${response.id}">Borrar</button>
                    <button class="deactivate-btn bg-gray-600 text-white px-2 py-1 rounded-md" data-id="${response.id}">Desactivar</button>
                `);
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    function deactivateProject(id) {
        $.ajax({
            url: `/proyectos/${id}/deactivate`,
            type: 'PATCH',
            data: {
                _token: $('input[name="_token"]').val()
            },
            success: function(response) {
                $(`#project-${id} td:nth-child(4)`).text('Inactive');
                $(`#project-${id} td:nth-child(6)`).html(`
                    <button class="bg-blue-600 text-white px-2 py-1 rounded-md view-btn" data-id="${response.id}">Ver</button>
                    <button class="edit-btn bg-yellow-500 text-white px-2 py-1 rounded-md" data-id="${response.id}">Editar</button>
                    <button class="delete-btn bg-red-600 text-white px-2 py-1 rounded-md" data-id="${response.id}">Borrar</button>
                    <button class="activate-btn bg-green-600 text-white px-2 py-1 rounded-md" data-id="${response.id}">Activar</button>
                `);
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    function deleteProject(id) {
        if (!confirm('Seguro que deseas borrar este proyecto?')) {
            return;
        }

        $.ajax({
            url: `/proyectos/${id}`,
            type: 'DELETE',
            data: {
                _token: $('input[name="_token"]').val()
            },
            success: function(response) {
                $(`#project-${id}`).remove();
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    function openViewModal(project) {
        $('#view_nombre').text(project.nombre);
        $('#view_responsable').text(project.responsable);
        $('#view_fecha_inicio').text(project.fecha_inicio);
        $('#view_estado').text(project.estado ? 'Activo' : 'Inactivo');
        $('#view_monto').text(project.monto);
        $('#updated_at').text(new Date(project.updated_at).toLocaleDateString('es-ES', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        }));

        document.getElementById('viewModal').classList.remove('hidden');
    }

    $(document).on('click', '.view-btn', function() {
        const id = $(this).data('id');
        $.ajax({
            url: `/proyectos/${id}`,
            type: 'GET',
            success: function(response) {
                openViewModal(response);
            },
            error: function(error) {
                console.error(error);
            }
        });
    });

    // Event delegation for dynamically added elements
    $(document).on('click', '.edit-btn', function() {
        const id = $(this).data('id');
        const project = {
            id: id,
            nombre: $(`#project-${id} td:nth-child(1)`).text(),
            responsable: $(`#project-${id} td:nth-child(2)`).text(),
            fecha_inicio: $(`#project-${id} td:nth-child(3)`).text(),
            estado: $(`#project-${id} td:nth-child(4)`).text() === 'Active' ? 1 : 0,
            monto: $(`#project-${id} td:nth-child(5)`).text()
        };
        openModal('updateModal', project);
    });

    $(document).on('click', '.delete-btn', function() {
        const id = $(this).data('id');
        deleteProject(id);
    });

    $(document).on('click', '.activate-btn', function() {
        const id = $(this).data('id');
        activateProject(id);
    });


    $(document).on('click', '.deactivate-btn', function() {
        const id = $(this).data('id');
        deactivateProject(id);
    });

    window.createProject = createProject;
    window.updateProject = updateProject;
    window.activateProject = activateProject;
    window.deactivateProject = deactivateProject;
    window.deleteProject = deleteProject;
    window.openModal = openModal;
    window.closeModal = closeModal;
});
