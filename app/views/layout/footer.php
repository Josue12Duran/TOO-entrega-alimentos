    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('click', function(e){
        if(e.target && e.target.matches('.btn-delete')){
            if(!confirm('¿Desea eliminar este registro?')) e.preventDefault();
        }
    });
    </script>
</body>
</html>
