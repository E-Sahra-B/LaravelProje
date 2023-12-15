"use client"
import React from 'react'
import axios from "axios";
import Link from 'next/link';
import { useState } from 'react';

const nav = () => {
    const [showModal, setShowModal] = useState(false);
    const [mailValue, setMailValue] = useState(null);

    const handleShow = () => setShowModal(true);
    const handleClose = () => setShowModal(false);

    function create() {
        axios.post('http://127.0.0.1:8000/api/addmail', {
            "mail": mailValue
        }).then(res => {
            alert('Kayıt başarıyla oluşturuldu.');
        })
        setMailValue(null);
        handleClose();
    }
    return (
        <>
            <ul className="navbar-nav me-auto mb-2 mb-lg-0 text-right py-2">
                <li className="nav-item">
                    <Link href={"/"} className="nav-link link-warning active" >Yenile</Link>
                </li>
                <li className="nav-item">
                    <button className="btn btn-outline-light" onClick={handleShow} data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Kayıt Ol
                    </button>
                    {/* Bootstrap Modal */}
                    <div className={`modal fade ${showModal ? 'show' : ''}`} tabIndex="-1" role="dialog" style={{ display: showModal ? 'block' : 'none' }} aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div className="modal-dialog modal-dialog-centered">
                            <div className="modal-content">
                                <div className="modal-header">
                                    <h1 className="modal-title fs-5 text-light" id="exampleModalLabel">Haber Bültenine Kayıt Ol.</h1>
                                    <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick={handleClose}></button>
                                </div>
                                <div className="modal-body text-light">
                                    <label htmlFor="inputData">Mail Adresinizi Giriniz:</label>
                                    <input
                                        type="text"
                                        id="inputData"
                                        onChange={e => { setMailValue(e.target.value) }}
                                        className="form-control"
                                    />
                                </div>
                                <div className="modal-footer">
                                    <button type="button" className="btn btn-light" onClick={create}>Kayıt Ol</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {/* End of Bootstrap Modal */}
                </li>
            </ul>
        </>
    )
}

export default nav
