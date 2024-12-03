<?php
// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar los cursos
$sql = "SELECT id, nombre_curso, duracion, descripcion, precio FROM cursos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar los resultados en una tabla
    echo "<section class='table-section'>
            <h2>Tabla de Cursos</h2>
            <table class='styled-table'>
            <thead>
                <tr>
                    <th>Curso</th>
                    <th>Duración</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>";
    // Recorrer los resultados y mostrar cada fila
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["nombre_curso"]. "</td>
                <td>" . $row["duracion"]. "</td>
                <td>" . $row["descripcion"]. "</td>
                <td>" . $row["precio"]. "</td>
              </tr>";
    }
    echo "</tbody>
        </table>
    </section>";
} else {
    echo "0 resultados";
}

// Cerrar conexión
$conn->close();
?>
