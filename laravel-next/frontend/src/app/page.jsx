import News from "./components/News";
import { getNews, getCategories } from '@/services/haber';

async function page({ params }) {
  const [news, categories] = await Promise.all([
    getNews("haberler"),
    getCategories("kategoriler")
  ]);
  return (
    <div>
      <section className="py-5 content  bg-dark">
        <div className="container px-4 px-lg-5 mt-5">
          <div className="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            {
              news?.map((dt, i) => (
                <News key={i} dt={dt} categories={categories} />
              ))
            }
          </div>
        </div>
      </section>
    </div>
  );
};

export default page;
