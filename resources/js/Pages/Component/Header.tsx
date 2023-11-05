import axios from "axios";
import React, {useEffect, useState} from "react";

export default function Header() {
    const [data, setData] = useState([]);

    useEffect(() => {
        axios.get('/api/v1/board').then((res) => {
            setData(res.data.data);
        });
    }, []);

    const listItem = function (): string {
        let tag: string = "";

        for (let prop in data) {
            data[prop].map((ele) => {
                let propId: number = parseInt(prop) + 1;
                let parentId: number = ele.parent_id;
                let lastOrderId: number = data[prop].length;

                if (propId === parentId) {
                    if (ele.depth === 1 && ele.order === 1) {
                        tag += `<div class="flex-col ml-5">`;
                        tag += `<div class="mb-2"><a href="/board/${ele.name_en}/post">${ele.name}</a></div>`;
                    }

                    if (ele.depth === 2) {
                        tag += `<div class="text-sm"><a href="/board/${ele.name_en}/post">${ele.name}</a></div>`;
                    }

                    if (ele.depth === 1 && (ele.order === lastOrderId) || ele.depth === 2 && (ele.order === lastOrderId)) {
                        tag += `</div>`;
                    }
                }
            });
        }

        return tag;
    };

    return (
        <header className="border-solid border-gray-300 border-b shadow-lg">
            <div className="max-w-[808px] flex justify-between ml-auto mr-auto pt-3 pb-3 pl-5 pr-5">
                <h1 className="text-xl font-bold tracking-wide"><a href="/" className="block">Lumii World</a></h1>
                <div className="flex items-baseline">
                    <nav className="flex mr-20">
                        <div className="flex items-baseline" dangerouslySetInnerHTML={{
                            __html: listItem()
                        }}>
                        </div>
                    </nav>
                    <a href="/api/admin/v1/members" className="ml-5 text-xs">관리자<br/>로그인</a>
                </div>
            </div>
        </header>
    );
}
