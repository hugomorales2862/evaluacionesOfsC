const validarImagen = () =>{
    let filename = document.getElementById("foto").files[0].name
    let filetype = document.getElementById("foto").files[0].type
     ///alert(filetype)
    if(filetype == 'application/pdf'){
        document.getElementById("label-file").innerText = filename
        document.getElementById("subir_foto").disabled = false
     
        
    }else{
        Swal.fire({
            icon: 'error',
            title: 'FORMATO NO ACEPTADO',
            text: 'El archivo debe ser PDF'
            
        })
        document.getElementById("subir_foto").disabled = true
        document.getElementById("label-file").innerText = "Seleccione un archivo"
        document.getElementById("foto").files[0] = ''
        document.getElementById("foto").value = ''
    }
}

const subir_archivo = () =>{

    let inputFile = document.getElementById("foto")
    let id = document.getElementById('registro_id').value
    let catalogo = document.getElementById('catalogo').value
 

    if(inputFile.files.length > 0 ){
        if(inputFile.files[0].type == 'application/pdf'){

            let formData = new FormData();
            
            formData.append("archivo", inputFile.files[0])
            formData.append("id",id)
            formData.append("catalogo",catalogo)
            
            // for (let pair of formData.entries()) {
            //     console.log(pair[0] + ": " + pair[1]);
            // }
            

            fetch("subirarchivo.php", {
                method: "POST",
                body: formData,
            })
    
            .then(respuesta => respuesta.text())
            .then(decodificado => {
                // let valores = decodificado
                alert(decodificado)
                //alert(decodificado)
                if(decodificado == 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'ARCHIVOS PDF GUARDADOS',
                        text: 'ARCHIVOS PDF FUERON GUARDADOS EXITOSAMENTE'
                        
                        })

                        //location.reload()
                       
                        setTimeout(()=>{location.reload()},2000)

                        
                }else if(decodificado == 2){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Contacte con el servidor 2'
                        
                        })
                }else if(decodificado == 0){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Contacte con el servidor 0'
                        
                        })
                }
                
                
            })
        }else{
            Swal.fire({
                icon: 'error',
                title: 'FORMATO NO ACEPTADO',
                text: 'El archivo debe tener extensión CSV'
                
            })           
        }
    }else{
        Swal.fire({
            icon: 'error',
            title: 'ARCHIVO VACIO',
            text: 'Seleccione un archivo'
            
        })
      
    }
}



// -------------------------
const validarImagen2 = () =>{
    let filename = document.getElementById("foto2").files[0].name
    let filetype = document.getElementById("foto2").files[0].type
    // alert(filetype)
    if(filetype == 'application/pdf'){
        document.getElementById("label-file").innerText = filename
        document.getElementById("subir_foto2").disabled = false
    }else{
        Swal.fire({
            icon: 'error',
            title: 'FORMATO NO ACEPTADO',
            text: 'El archivo debe ser PDF'
            
        })
        document.getElementById("subir_foto2").disabled = true
        document.getElementById("label-file").innerText = "Seleccione un archivo"
        document.getElementById("foto2").files[0] = ''
        document.getElementById("foto2").value = ''
    }
}

const Modificar_archivo = () =>{
    let inputFile = document.getElementById("foto2")
    let ruta = document.getElementById('ruta').value
    // alert(id)
    if(inputFile.files.length > 0 ){
        if(inputFile.files[0].type == 'application/pdf'){

            let formData = new FormData();
            formData.append("archivo", inputFile.files[0])
            formData.append("ruta",ruta)
            fetch("Modificar_archivo.php", {
                method: "POST",
                body: formData,
            })
    
            .then(respuesta => respuesta.text())
            .then(decodificado => {
                // let valores = decodificado
                console.log(decodificado)
                if(decodificado == 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Registros Modificados',
                        text: 'Registros Modificados exitosamente'
                        
                        })
                        // location.reload()
                        setTimeout(()=>{location.reload()},1000)

                }else if(decodificado == 2){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Contacte con el servidor, 2'
                        
                        })
                }
                else if(decodificado == 0){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Contacte con el servidor, 0'
                        
                        })
                }
                
                
            })
        }else{
            Swal.fire({
                icon: 'error',
                title: 'FORMATO NO ACEPTADO',
                text: 'El archivo debe tener extensión CSV'
                
            })
           
        }
    }else{
        Swal.fire({
            icon: 'error',
            title: 'ARCHIVO VACIO',
            text: 'Seleccione un archivo'
            
        })
       
    }
}

/////////////////////////////////
const validarImagen3 = () =>{
    let filename = document.getElementById("foto3").files[0].name
    let filetype = document.getElementById("foto3").files[0].type
    // alert(filetype)
    if(filetype == 'application/pdf'){
        document.getElementById("label-file").innerText = filename
        document.getElementById("subir_foto3").disabled = false
    }else{
        Swal.fire({
            icon: 'error',
            title: 'FORMATO NO ACEPTADO',
            text: 'El archivo debe ser PDF'
            
        })
        document.getElementById("subir_foto3").disabled = true
        document.getElementById("label-file").innerText = "Seleccione un archivo"
        document.getElementById("foto3").files[0] = ''
        document.getElementById("foto3").value = ''
    }
}

const subir_archivo2 = () =>{

    let inputFile = document.getElementById("foto3")
    let id = document.getElementById('registro_id2').value
    //alert(id)

    if(inputFile.files.length > 0 ){
        if(inputFile.files[0].type == 'application/pdf'){

            let formData = new FormData(); 
            
            formData.append("archivo", inputFile.files[0])
            formData.append("id",id)
           

            fetch("subirarchivo2.php", {
                method: "POST",
                body: formData,
            })
    
            .then(respuesta => respuesta.text())
            .then(decodificado => {
                // let valores = decodificado
                console.log(decodificado)
                if(decodificado == 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'ARCHIVO PDF GUARDADO',
                        text: 'ARCHIVO PDF GUARDADO EXITOSAMENTE'
                        
                        })

                        //location.reload()
                       
                        setTimeout(()=>{location.reload()},1500)

                        
                }else if(decodificado == 2){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Contacte con el servidor, 2'
                        
                        })
                }
                else if(decodificado == 0){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Contacte con el servidor, 0'
                        
                        })
                }
                
                
            })
        }else{
            Swal.fire({
                icon: 'error',
                title: 'FORMATO NO ACEPTADO',
                text: 'El archivo debe tener extensión CSV'
                
            })
           
        }
    }else{
        Swal.fire({
            icon: 'error',
            title: 'ARCHIVO VACIO',
            text: 'Seleccione un archivo'
            
        })
      
    }
}
///////////////////////
const validarImagen4 = () =>{
    let filename = document.getElementById("foto4").files[0].name
    let filetype = document.getElementById("foto4").files[0].type
    // alert(filetype)
    if(filetype == 'application/pdf'){
        document.getElementById("label-file").innerText = filename
        document.getElementById("subir_foto4").disabled = false
    }else{
        Swal.fire({
            icon: 'error',
            title: 'FORMATO NO ACEPTADO',
            text: 'El archivo debe ser PDF'
            
        })
        document.getElementById("subir_foto4").disabled = true
        document.getElementById("label-file").innerText = "Seleccione un archivo"
        document.getElementById("foto4").files[0] = ''
        document.getElementById("foto4").value = ''
    }
}

const Modificar_archivo2 = () =>{
    let inputFile = document.getElementById("foto4")
    let ruta2 = document.getElementById('ruta2').value
    //alert(ruta)
    if(inputFile.files.length > 0 ){
        if(inputFile.files[0].type == 'application/pdf'){

            let formData = new FormData();
            formData.append("archivo", inputFile.files[0])
            formData.append("ruta",ruta2)
            fetch("Modificar_archivo2.php", {
                method: "POST",
                body: formData,
            })
    
            .then(respuesta => respuesta.text())
            .then(decodificado => {
                // let valores = decodificado
                console.log(decodificado)
                if(decodificado == 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Registros Modificados',
                        text: 'Registros Modificados Exitosamente'
                        
                        })
                        //location.reload()
                        setTimeout(()=>{location.reload()},1500)
                    }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Contacte con el servidor'
                        
                        })
                }
                
                
            })
        }else{
            Swal.fire({
                icon: 'error',
                title: 'FORMATO NO ACEPTADO',
                text: 'El archivo debe tener extensión CSV'
                
            })
           
        }
    }else{
        Swal.fire({
            icon: 'error',
            title: 'ARCHIVO VACIO',
            text: 'Seleccione un archivo'
            
        })
       
    }
}