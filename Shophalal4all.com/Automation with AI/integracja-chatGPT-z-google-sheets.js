const OPENAI_API_KEY = 'tutaj-klucz-API-do-chatgpt';

function getGPTResponse(prompt) {
  const url = 'https://api.openai.com/v1/chat/completions';
  const payload = {
    model: 'gpt-3.5-turbo',
    messages: [{"role": "user", "content": prompt}],
    max_tokens: 150,
    n: 1,
    stop: null,
    temperature: 0.7
  };
  const options = {
    method: 'post',
    contentType: 'application/json',
    headers: {
      'Authorization': Bearer ${OPENAI_API_KEY}
    },
    payload: JSON.stringify(payload),
    muteHttpExceptions: true
  };

  const response = UrlFetchApp.fetch(url, options);
  const statusCode = response.getResponseCode();
  if (statusCode !== 200) {
    const error = JSON.parse(response.getContentText());
    Logger.log('Error: ' + error.message);
    return 'API Error: ' + error.message;
  }

  const json = response.getContentText();
  const result = JSON.parse(json);
  return result.choices[0].message.content.trim();
}

function GPTFunction(prompt) {
  return getGPTResponse(prompt);
}