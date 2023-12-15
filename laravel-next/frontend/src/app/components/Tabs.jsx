"use client"
import React from 'react'
import Link from 'next/link'
import { useSearchParams } from 'next/navigation'

const Tabs = () => {
    const searchParams = useSearchParams()
    const link = searchParams.get('get')
    const tabs = [
        { url: "all", name: "En Son Haberler" },
        { url: "week", name: "Kategoriler" },
        { url: "all", name: "Tüm Haberler" },
    ]

    return (
        <div>
            <ul className="nav justify-content-center bg-dark mt-5 py-3">
                {
                    tabs.map((tab, index) => (
                        <li className="nav-item pt-3">
                            <Link className={`nav-link ${tab.url === link ? "active link-warning" : " link-light"}`}
                                aria-current="page" href={`/?get=${tab.url}`}>{tab.name}</Link>
                        </li>
                    ))
                }
            </ul>
        </div>
    )
}

export default Tabs
