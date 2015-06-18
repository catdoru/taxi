package sample.proto;

message ServerStatusAnswer {
    optional int32 threadCount = 1;
    repeated string listeners = 2;
}