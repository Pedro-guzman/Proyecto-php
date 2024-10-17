<?php require( 'init.php' ) ?>
<!-- Esta línea incluye el archivo 'init.php', que normalmente contiene configuraciones esenciales o inicializaciones necesarias para el funcionamiento del sitio web. -->

<?php

$all_posts = get_all_posts();
// Recupera todos los posts de la base de datos y los almacena en la variable '$all_posts'.

$post_found = false;
// Inicializa la variable '$post_found' como falsa, que se usará para determinar si se encontró un post específico para mostrar.

if ( isset( $_GET['view'] ) ) {
  // Verifica si se ha pasado el parámetro 'view' en la URL, que indica que se quiere ver un post específico.

  $post_found = get_post( $_GET['view'] );
  // Busca el post usando el ID pasado en el parámetro 'view'. Si encuentra el post, lo asigna a '$post_found'.

  if ( $post_found ) {
    // Si el post fue encontrado:

    $all_posts = [ $post_found ];
    // Sobrescribe '$all_posts' para que contenga solo el post que se está visualizando.
  }
}

?>
<?php require( 'templates/header.php' ); ?>
<!-- Incluye el archivo 'header.php', que normalmente contiene el encabezado o la parte superior de la página. -->

<?php if ( isset( $_GET['success'] )):?>
<!-- Verifica si en la URL se ha pasado el parámetro 'success', que indica que un post ha sido creado con éxito. -->

<div class="success">
  <strong>¡El post ha sido creado!</strong>
  <!-- Muestra un mensaje de éxito si el post ha sido creado. -->
</div>
<?php endif; ?>

<div class="posts">
    <?php foreach ( $all_posts as $post ): ?>
    <!-- Recorre todos los posts almacenados en '$all_posts' y los muestra en la página. -->

        <article class="post">
            <header>
                <h2 class="post-title">
                    <!-- Enlace para ver el post específico usando el ID del post en la URL -->
                    <a href="?view=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a>
                </h2>
            </header>
            <div class="post-content">
                <?php if ( $post_found ): ?>
                <!-- Si se encontró un post específico, muestra el contenido completo del post. -->
                    <?php echo $post['content']; ?>
                <?php else: ?>
                <!-- Si no se está visualizando un post específico, muestra solo el resumen (excerpt) del post. -->
                    <?php echo $post['excerpt']; ?>
                <?php endif; ?>
            </div>
            <footer>
                <span class="post-date">
                    Publicada en:
                    <?php
                        // Usar DateTime para formatear la fecha
                        $fecha = new DateTime($post['published_on']);
                        // Convierte la fecha de publicación almacenada en la base de datos en un objeto DateTime.

                        echo $fecha->format('d M Y');
                        // Muestra la fecha en formato día, mes, año.
                    ?>
                </span>


            </footer>
        </article>
    <?php endforeach; ?>
    <!-- Finaliza el bucle que muestra todos los posts. -->
</div>

<?php require( 'templates/footer.php' ); ?>
<!-- Incluye el archivo 'footer.php', que normalmente contiene el pie de página del sitio web. -->
