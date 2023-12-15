const API_URL = process.env.API_URL;

const fetchNewApi = async (pathname, id = "") => {
  try {
    const res = await fetch(`${API_URL}/${pathname}/${id}`);
    return res.json();
  } catch (error) {
    console.error("Error fetching data:", error);
  }
};

const getNews = async (pathname) => {
  return fetchNewApi(pathname);
};

const getNewsDetail = async (pathname, id = "") => {
  return fetchNewApi(pathname, id);
};

const getCategories = async (pathname) => {
  return fetchNewApi(pathname);
};

export { fetchNewApi, getNews, getCategories, getNewsDetail };
