import React from "@inertiajs/react";
import {MemberContext} from "../Layout/MemberContext";
import {ReactElement, useEffect, useRef, useState} from "react";

type Props = {
    board_name: string
    post_id: number,
    children: ReactElement,
    formData: any
}

export default function Auth({board_name, post_id, children, formData}: Props) {
    //data-url={`/board/${board_name}/post/${post_id}`}
    //data-url={`/board/${board_name}/post/${post_id}/edit`
    //data-url={`/board/${board_name}/post/${post_id}`}
    const form = useRef("");
    let [url, setUrl] = useState({'method': '', 'url': ''});

    const handleClick = function (e) {
        //콘텐츠 갱신은 클릭시에 진행
        formData.content = document.querySelector('.ProseMirror.toastui-editor-contents')?.innerHTML;
        setUrl({'method' : e.target.dataset.method, 'url' : e.target.dataset.url});

        console.log(url);
    }

    return (
        <MemberContext.Consumer>
            {value => value.is_admin ?
                <>
                    <form action="" method="" ref={form} onClick={handleClick}>
                        <div className="flex justify-end mb-3">
                            <button type="button" data-url={`/api/v1/board/${board_name}/post/${post_id}`} data-method="patch" className="mr-3">글갱신</button>
                            <button type="button" data-url={`/board/${board_name}/post/${post_id}/edit`} data-method="get" className="mr-3">글편집</button>
                            <button type="button" data-url={`/api/v1/board/${board_name}/post/${post_id}`} data-method="DELETE">글삭제</button>
                        </div>
                        {children}
                    </form>
                </>
                : ""}
        </MemberContext.Consumer>
    );
}
