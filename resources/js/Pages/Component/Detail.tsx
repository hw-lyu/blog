import React from "@inertiajs/react";
import HomeLayout from "../Layout/HomeLayout";
import {useEffect, useState} from "react";
import axios from "axios";
import Auth from "./Auth";

type Props = {
    board_name: string
    post_id: number
}

export default function Detail({board_name, post_id}: Props) {
    const [data, setData] = useState([]);

    useEffect(() => {
        axios.get(`/api/v1/board/${board_name}/post/${post_id}`)
            .then((res) => {
                setData(res.data.post);
            });
    }, []);

    return (
        <HomeLayout children>
            <Auth board_name={board_name} post_id={post_id} formData="" children=""></Auth>
            <div className="mockup-browser border bg-base-300 mb-10">
                <div className="mockup-browser-toolbar">
                    <div className="input"><span className="align-sub">{data.subject} #{data.tag_name_ko}</span>
                    </div>
                </div>
                <div className="flex justify-center px-4 py-16 bg-base-200">
                    <div className="w-full" dangerouslySetInnerHTML={{__html: data.content}}></div>
                </div>
            </div>
        </HomeLayout>
    )
}
