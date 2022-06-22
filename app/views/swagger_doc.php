<?php
    require_once '../app/require.php';
?>

<html>
    <head>
    <meta charset="UTF-8">
    <title>Swagger UI</title>
    <link rel="stylesheet" type="text/css" href="../public/dist/swagger-ui.css" >
    <link rel="icon" type="image/png" href="../public/dist/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="../public/dist/favicon-16x16.png" sizes="16x16" />
    <style>
      html
      {
        box-sizing: border-box;
        overflow: -moz-scrollbars-vertical;
        overflow-y: scroll;
      }
      *,
      *:before,
      *:after
      {
        box-sizing: inherit;
      }

      body
      {
        margin:0;
        background: #fafafa;
      }
    </style>
    </head>
    <body>
        <div id="swagger-ui"></div>
        <script src="https://unpkg.com/swagger-ui-dist@3.12.1/swagger-ui-standalone-preset.js"></script>
        <script src="https://unpkg.com/swagger-ui-dist@3.12.1/swagger-ui-bundle.js"></script>
        <script>
        window.onload = function() {
        // Begin Swagger UI call region
            console.log(window.location.pathname);
        const ui = SwaggerUIBundle({
            url: "../public/swagger.json",
            dom_id: '#swagger-ui',
            deepLinking: true,
            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIStandalonePreset
            ],
            layout: "StandaloneLayout"
        })
        // End Swagger UI call region
        window.ui = ui
        }
    </script>
    </body>
</html>