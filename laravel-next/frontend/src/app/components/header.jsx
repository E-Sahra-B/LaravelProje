import Nav from './nav';
import { Inter } from "next/font/google";
import Link from 'next/link';
import { BiSearch } from 'react-icons/bi'
const inter = Inter({ subsets: ["latin"] });

const header = () => {
    return (
        <nav className="navbar bg-primary navbar-expand-lg bg-body-tertiary fixed-top" data-bs-theme="dark">
            <div className="container-fluid d-flex justify-space-around">
                <div>
                    <Link href={"/"} className="`{inter.className}` navbar-brand bg-warning rounded text-bold h1 my-auto p-2 text-dark" >Haberiye</Link>
                </div>
                <form className="d-flex col-8" role="search">
                    <div class="input-group">
                        <input className=" w-50 form-control me-2" type="text" placeholder="Search" aria-label="Search" />
                        <span class="input-group-append">
                            <button type='submit' class="input-group-text bg-transparent"><BiSearch size={25} /></button>
                        </span>
                    </div>
                </form>
                <div>
                    <div className="collapse navbar-collapse" id="navbarSupportedContent">
                        <Nav></Nav>
                    </div>
                </div>
                <div>
                    <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span className="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>
        </nav>
    )
}

export default header