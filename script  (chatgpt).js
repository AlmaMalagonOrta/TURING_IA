async function sendInstruction() {
    const instruction = document.getElementById('instruction').value;
    const responseElement = document.getElementById('response');

    // Mostrar un mensaje de carga mientras se obtiene la respuesta
    responseElement.innerHTML = 'Cargando...';

    try {
        const response = await fetch('https://api.openai.com/v1/engines/davinci-codex/completions', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer sk-proj-CYORQY4pxfxEagCLb1j7T3BlbkFJ1FLbL7WbUdPWzgVuQf97'
            },
            body: JSON.stringify({
                prompt: instruction,
                max_tokens: 50
            })
        });

        const data = await response.json();
        responseElement.innerHTML = data.choices[0].text;
    } catch (error) {
        responseElement.innerHTML = 'Error al obtener la respuesta de la API.';
        console.error('Error:', error);
    }
}
