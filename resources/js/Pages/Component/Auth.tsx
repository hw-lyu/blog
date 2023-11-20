import React from "@inertiajs/react";
import {MemberContext} from "../Layout/MemberContext";
import {ReactElement, useEffect} from "react";
import axios from "axios";

type Props = {
    board_name: string
    post_id: number,
    children: ReactElement,
    formData: any
}

export default function Auth({board_name, post_id, children, formData}: Props) {
    const handleClick = function (e) {
        const contentEle: Element | null = document.querySelector('.ProseMirror.toastui-editor-contents');
        let eTarget = e.target;

        console.log(contentEle);

        if (eTarget.tagName === "BUTTON") {
            let options = {
                method: eTarget.dataset.method,
                url: eTarget.dataset.url || "",
                data: {
                    ...formData,
                    id: post_id,
                    content: contentEle?.innerHTML,
                }
            };

            axios(options)
                .then(function (res) {
                    if (res.statusText !== "OK") {
                        return alert("요청을 다시 확인해주세요");
                    }

                    console.log(res.data.updated);
                    return alert(res.data.updated === 1 ? "글 수정이 완료 되었습니다." : "글 삭제가 완료 되었습니다.");
                });
        }
    }

    return (
        <MemberContext.Consumer>
            {
                (value: { is_admin: boolean; }): Element | string => value.is_admin ?
                    <>
                        <div onClick={handleClick}>
                            <div className="flex justify-end mb-3">
                                <button type="button" data-url={`/api/v1/board/${board_name}/post/${post_id}`}
                                        data-method="patch" className="mr-3">글갱신
                                </button>
                                <a href={`/board/${board_name}/post/${post_id}/edit`} className="mr-3">글편집</a>
                                <button type="button" data-url={`/api/v1/board/${board_name}/post/${post_id}`}
                                        data-method="DELETE">글삭제
                                </button>
                            </div>
                        </div>
                    </> : ""
            }
        </MemberContext.Consumer>
    );
}
