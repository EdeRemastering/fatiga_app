
    // Obtiene la URL actual
    const path = window.location.pathname;

    // Divide la URL en segmentos usando '/' como delimitador
    const segments = path.split('/').filter(segment => segment !== "");

    // Variable para almacenar el título
    let titulo = "";

    // Verifica si la URL contiene "edit"
    const editIndex = segments.indexOf("edit");
    if (editIndex !== -1 && editIndex > 1) {
        // Si "edit" está en la URL, toma el segundo segmento anterior
        const mainSection = segments[editIndex - 2];
        titulo = `Editar ${capitalize(mainSection)}`;
    } 
    // Verifica si la URL contiene "create" al final
    else if (segments.includes("create")) {
        const mainSection = segments[segments.length - 2];
        titulo = `Crear ${capitalize(mainSection)}`;
    } 
    // Si no contiene ni "edit" ni "create", muestra el último segmento
    else if (segments.length >= 1) {
        titulo = capitalize(segments[segments.length - 1]);
    }

    // Función para capitalizar la primera letra
    function capitalize(word) {
        return word.charAt(0).toUpperCase() + word.slice(1);
    }

    // Establece el título en el elemento h2
    document.getElementById("titulo-pagina").textContent = titulo;
