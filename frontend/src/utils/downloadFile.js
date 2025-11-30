import { getToken } from './auth';

const cleanFileUrl = (url) => {
  if (url.includes('localhost') || url.includes('127.0.0.1')) {
    const apiBaseUrl = process.env.REACT_APP_API_URL;
    const path = new URL(url).pathname + new URL(url).search;
    return apiBaseUrl + path;
  }
  return url;
};

export const downloadFile = async (fileUrl, filename = 'document') => {
  const finalUrl = cleanFileUrl(fileUrl);

	try {
    const token = getToken();

    const isAbsoluteUrl = finalUrl.startsWith('http://') || fileUrl.startsWith('https://');
    const fullUrl = isAbsoluteUrl ? finalUrl : `${process.env.REACT_APP_API_URL}${finalUrl}`;

    const response = await fetch(fullUrl, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });

    if (!response.ok) throw new Error('Ошибка загрузки файла');

    const blob = await response.blob();
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
  } catch (err) {
    console.error('Не удалось скачать файл:', err);
    alert('Не удалось скачать файл');
  }
};