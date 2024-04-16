export interface IProduct {
    id: string;
    name: string;
    image: string[];
    memo: string;
    category_id: string;
    sub_category_id: string;
    status: number;
    price: number;
    inew: boolean;
    views: number;
    quantity_sold: number;
}

export interface IProductDetail {
    id: string;
    product_id: string;
    cpu: string;
    ram: number;
    display_size: number;
    display_memo: string;
    capacity_rom: number;
    type_rom: number; // 0 - HDD / 1 - SSD
    camera: string;
    weight: number;
    battery: string;
    description: string;
}