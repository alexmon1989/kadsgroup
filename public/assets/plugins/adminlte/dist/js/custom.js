/*
 Все таблицы, что надо будут иметь данные, будт иметь id=data. Превращаем их в "умные" dataTables
 */
$(document).ready(function() {
    $('#data').dataTable({
        "stateSave": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.7/i18n/Russian.json"
        }
    });

    // Подтверждение удаления
    $('.item-delete').click(function() {
        return confirm('Вы уверены?');
    });
} );