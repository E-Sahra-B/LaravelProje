"use client";
import { useEffect } from "react";

function BootstrapClient() {
    useEffect(() => {
        return () => {
            require("bootstrap/dist/js/bootstrap.bundle");
        };
    }, []);
    return null;
}

export default BootstrapClient;
