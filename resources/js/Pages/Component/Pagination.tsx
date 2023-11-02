import React from "@inertiajs/react";
import {ReactElement} from "react";

type Props = {
    children : ReactElement
}
export default function Pagination({children} : Props) {
    return (
        <div className="join flex justify-center">
            {children}
        </div>
    );
}
