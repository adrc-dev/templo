<x-mail::message>
    # Nuevo mensaje de contacto

    Nombre:
    {{ $data['name'] }}

    Teléfono:
    {{ $data['phone'] }}

    Email:
    {{ $data['email'] }}


    Mensaje:
    {{ $data['message'] }}

    Este mensaje ha sido enviado desde el formulario de contacto de Jardín del Despertar.
</x-mail::message>
