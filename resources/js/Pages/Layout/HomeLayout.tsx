import React from '@inertiajs/react';
import Header from "../Component/Header";
import {ReactElement} from "react";

type Props = {
    children: ReactElement
}

export default function HomeLayout({children}: Props) {
    return (
        <div className="wrap">
            <Header></Header>
            <div className="max-w-[808px] mt-10 ml-auto mr-auto pt-3 pb-3 pl-5 pr-5">
                {children}
            </div>
        </div>
    );
}
