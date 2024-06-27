<link rel="stylesheet" href="../../css/loader_spin.css?v=<?php echo (rand()); ?>" />

<script>
    function viewLoader() {
        var loader = document.getElementById("load_spin_fade")

        loader.style.display = "flex"
    }

    function hideLoader() {
        var loader = document.getElementById("load_spin_fade")

        loader.style.display = "none"
    }
</script>

<div id="load_spin_fade">

    <div id="cont_loader_spin">

        <div id="loader_spin"></div>
        <br>
        <span>Procesando...</span>
    </div>
</div>