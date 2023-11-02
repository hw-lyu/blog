import React from '@inertiajs/react';
import {ReactElement} from "react";

type Props = {
    name_ko: string,
    children: ReactElement
}

export default function TagList({name_ko, children}: Props) {
    return (
        <>
            <p className="flex mb-2">#{name_ko ?? '태그명'}</p>
            <ul className="flex flex-col">
                {children}
            </ul>
        </>
    );
}
