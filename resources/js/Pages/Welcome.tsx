import axios from "axios";
import React from '@inertiajs/react';
import {useState, useEffect} from "react";
import List from "./Component/List";
import HomeLayout from "./Layout/HomeLayout";
import Pagination from "./Component/Pagination";

const Welcome = () => {
    const [data, setData] = useState([]);
    const [PaginationData, setPaginationData] = useState([]);

    useEffect(() => {

        axios.get(`/api/v1${location.pathname === '/' ? '/board/all/post' : location.pathname}${location.search}`).then((res) => {
            setData(res.data.post.data);
            setPaginationData(res.data.post.links);
        });
    }, []);

    return (
        <HomeLayout children>
            {
                data.map((ele: any, idx: number) => {
                    return (
                        <List key={idx} post_id={ele.id} subject={ele.subject} strip_content={ele.strip_content}
                              created_at={ele.created_at}
                              file_url={JSON.parse(ele.file_data).url}>
                        </List>
                    )
                })
            }

            <Pagination children>
                {
                    PaginationData.map((ele: any, idx: number) => {
                        return (
                            <a href={ele.url?.replace('/api/v1', '')} key={idx}
                               className={`join-item btn${ele.active ? ' btn-active' : ''}`}
                               dangerouslySetInnerHTML={{__html: ele.label}}></a>
                        )
                    })
                }
            </Pagination>
        </HomeLayout>
    )
}

export default Welcome
