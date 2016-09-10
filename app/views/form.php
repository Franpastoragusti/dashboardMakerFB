

        <form class="uk-panel uk-panel-box uk-form uk-border-rounded" action='index.php' method='post'>

            <div class="uk-form-row">
                <label for="csv">Introduce la ruta del CSV</label>
                    <input class="uk-width-1-1 uk-form-large" type="text" name='csv' id='csv' placeholder="Ruta del csv">
            </div>
            <div class="uk-form-row">
                <label for="title">Introduce un nombre para el análisis</label>
                    <input class="uk-width-1-1 uk-form-large" type="text" name='title' id='title' placeholder="Titulo del excel">
            </div>
            <div class="uk-form-row">
                <input type='submit' value='Generar Análisis' class="uk-width-1-1 uk-button uk-button-primary uk-button-large"/>
            </div>
        </form>