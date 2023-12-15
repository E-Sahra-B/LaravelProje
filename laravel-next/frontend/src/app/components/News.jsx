"use client"
import React from 'react'
import Image from 'next/image';
import { useRouter } from 'next/navigation';

const News = ({ dt, categories }) => {
    const router = useRouter();
    return (
        <div onClick={() => router.push(`/new/${dt?.id}`)} className='col mb-5'>
            <div className='card h-100'>
                <div className='badge bg-warning text-white position-absolute'>{categories.find(kategori => kategori.id === dt.kategori_id)?.ad}</div>
                <Image src='https://i.pravatar.cc/100' width='100' height='100' className='card-img-top' alt='resimBaslik' />
                <div className='card-body p-4'>
                    <div className='text-center'>
                        <h5 className='fw-bolder text-warning'>{dt?.baslik}</h5>
                        <div className='d-flex justify-content-center small mb-2'>
                            <p>{dt?.icerik}</p>
                        </div>
                    </div>
                </div>
                <div className='card-footer p-4 pt-0 border-top-0 bg-transparent'>
                    <div className='text-center'>
                        <button className='btn btn-warning mt-auto' onClick={() => router.push(`/new/${dt?.id}`)}>Devamı..</button>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default News
