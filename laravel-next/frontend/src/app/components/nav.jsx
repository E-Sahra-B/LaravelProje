import React from 'react'
import Link from 'next/link';

const nav = () => {
    return (
        <>
            <ul className="navbar-nav me-auto mb-2 mb-lg-0 text-right py-2">
                <li className="nav-item">
                    <Link href={"/"} className="nav-link link-warning active" >Yenile</Link>
                </li>
                <li className="nav-item">
                    <Link href={"/"} className="nav-link link-light" >Giriş Yap</Link>
                </li>
            </ul>
        </>
    )
}

export default nav
