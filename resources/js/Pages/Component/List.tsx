import React from "@inertiajs/react";

type listProps = {
    cate: string
}
export default function List({ cate }: listProps) {
    return (
        <div>
            {cate}
        </div>
    )
}
