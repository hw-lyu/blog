import React from "@inertiajs/react";
import {MemberContext} from "../Layout/MemberContext";

type Props = {
    key: number,
    post_id: number,
    subject: string,
    strip_content: string,
    files: object,
    created_at: string
}
export default function List({post_id, subject, strip_content, files, created_at}: Props) {
    return (
        <>
            <div className="card card-side bg-base-100 shadow-xl mb-10">
                <figure className="basis-1/3"><img src={files[0] !== undefined ? files[0]['url'] : files['url']}
                                                   alt={subject} className="w-full h-full object-cover"/></figure>
                <div className="card-body basis-2/3">
                    <h2 className="card-title leading-6	line-clamp-2 break-all">{subject}</h2>
                    <p className="leading-6	line-clamp-3 break-all">{strip_content}</p>
                    <p className="mt-3">{new Date(created_at).toLocaleString()}</p>
                    <div className="card-actions justify-end">
                        <a href={`${location.pathname === '/' ? '/board/all/post' : location.pathname}/${post_id}`}
                           className="btn btn-primary">보기</a>
                    </div>
                </div>
            </div>
        </>
    )
}
