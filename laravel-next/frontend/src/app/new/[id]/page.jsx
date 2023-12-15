import { getNewsDetail, getCategories } from '@/services/haber';

async function page({ params }) {
    const id = params.id;
    const [newsDetail, categories] = await Promise.all([
        getNewsDetail("haberler", id),
        getCategories("kategoriler")
    ]);

    return (
        <div>
            <section className="bg-dark py-1">
                <div className="container px-4 px-lg-5 my-5">
                    <div className="text-center text-white">
                        <h3 className="fw-bolder">{newsDetail.baslik}</h3>
                    </div>
                </div>
            </section>
            <section className="py-5 content">
                <div className="container px-4 px-lg-5 my-5">
                    <div className="row gx-4 gx-lg-5 align-items-center">
                        <div className="col-md-6">
                            <img className="mb-5 mb-md-0" width='450' height='450' src="https://i.pravatar.cc/100" alt="" />
                        </div>
                        <div className="col-md-6">
                            <div className="small mb-1">Kategori: {categories.find(kategori => kategori.id === newsDetail.kategori_id)?.ad}</div>
                            <h3 className="display-5 fw-bolder">{newsDetail.baslik}</h3>
                            <div className="fs-5 mb-5">
                                <span>{newsDetail.icerik}</span>
                            </div>
                            <p><br /></p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    )
}

export default page
