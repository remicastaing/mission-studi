$(function () {

    checkAgents();

    $('select[name="pays"]').change(function (e) {
        pays = $(this).val();

        $.get("ajax-planque.php?id=" + pays, function (data, status) {
            $("#planque").replaceWith(data);
        });

        $.get("ajax-contact.php?id=" + pays, function (data, status) {
            $("#contact").replaceWith(data);
        });
    })

    $('select[name="cible[]"]').change(refresAgents);

    $('select[name="specialite"]').change(refresAgents);


    function refresAgents() {
        cible = $('select[name="cible[]"]').val();
        specialite = $('#specialite :selected').val();
        console.log(cible);
        console.log(specialite);
        $.ajax({
            url: "ajax-agent.php",
            type: "get",
            data: {
                cible: cible,
                specialite: specialite
            },
            success: function (data) {
                $("#agent").replaceWith(data);
                checkAgents();
            }
        });

    }

    $('select[name="agent[]"]').change(checkAgents);

    function checkAgents() {

        selectAgents = $('select[name="agent[]"]');

        if (isAgentsValid()) {
            selectAgents.removeClass('is-invalid');
        } else {
            selectAgents.addClass('is-invalid');
        }
    }

    function isAgentsValid() {
        return $('#agent :selected').text() !== '' && $('#agent :selected').text().includes('***');
    }

    $('#enregistrer').click(function (event) {
        if (!isAgentsValid()) {
            event.preventDefault();
        }
    });

});