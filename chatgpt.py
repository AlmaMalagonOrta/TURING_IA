
import openai

# Asegúrate de haber configurado tu clave de API de OpenAI
openai.api_key = 'sk-proj-CYORQY4pxfxEagCLb1j7T3BlbkFJ1FLbL7WbUdPWzgVuQf97'


# Crear una completación utilizando el modelo 'gpt-3.5-turbo'
response = openai.ChatCompletion.create(
    model="gpt-3.5-turbo",
    messages=[
        {"role": "system", "content": "Eres un asistente útil."},
        {"role": "user", "content": "Hola, ¿cómo estás?"}
    ],
    max_tokens=50
)

# Imprimir la respuesta
print(response.choices[0].message['content'].strip())

